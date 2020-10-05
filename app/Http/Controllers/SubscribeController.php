<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;

use App\Models\User;

class SubscribeController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        return view('subscribe.index', [
            'intent' => $user->createSetupIntent()
        ]);
    }

    public function subscribe( Request $request )
    {
        $user = $request->user();

       //dd($request->all());

        if(! $user)
        {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            // create and login user

            try 
            {
                $user = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                ]);

                Auth::login($user);

            } catch(\Exception $e)
            {
                return back()->withErrors(['message' => 'Problem in creating user!']);
            }

        }

        //$stripeCustomer = $user->createOrGetStripeCustomer();

        // create the user subscription

        // 1: get credit card token
        //$ccToken = $request['cc_token'];
        //$plan = $request['plan'];

        // 2: create subscription

       try 
       {
           $user->newSubscription('main', $request['plan'])->create($request['payment_method'], [
                'email' => $user->email
            ]);
       } 
        catch(\Exception $e)
       {
           dd($e->getMessage());
           return back()->withErrors(['message' => $e->getMessage()]);
       }

        // OR with meta data
        // $user->newSubscription('main', $plan)->create($ccToken. [
        //     'email' => $user->email
        // ], [
        //     'metadata' => ['note' => 'Some extra information.'],
        // ]);

        return redirect('welcome');



        return 'subscribe';
    }
}

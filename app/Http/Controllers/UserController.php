<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Videos;
use App\Models\categories;
use App\Helper\UserService;
use App\Models\PaymentPlan;
use Illuminate\Support\Str;
use App\Helper\LoginService;
use App\Models\ActivePlans;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $token = Str::random(64);

        $userid = rand(1111, 9999);
        // set user account to 0 none active account
        $status = '0';

        $response = (new UserService($userid, $request->name, $request->username, $request->email, $request->password, $status))->register($request->devicename);

        //if registration was successful send a email to verify account to activate it
        // if($response){
        //     Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
        //         $message->to($request->email);
        //         $message->subject("Email verification");
        //     });
        // }

        return response()->json($response);
    }

    public function login(Request $request)
    {

        // $user = (filter_var($request->username, FILTER_VALIDATE_EMAIL) || $request->username) ? 'email' : 'username';
        // $request->merge([
        //     $user => $request->username
        // ]);
        // if (auth()->attempt($request->only($user, 'password'))){

        // }
        // check if user account has been verified
        $response = (new LoginService($request->username, $request->password))->login();
        return response()->json($response);
    }


    // select all categories, limit to 3, in random order
    public function category()
    {
        $category = categories::inRandomOrder()->limit(3)->get();

        if ($category) {
            return response()->json($category);
        } else {
            return response()->json([
                'error' => $category->errors()->messages()
            ], 404);
        }
    }

    // select first category
    public function firstCategory()
    {
        $firstCategory = categories::select('name')->take(1)->first();
        if ($firstCategory) {
            return response()->json($firstCategory);
        } else {
            return response()->json([
                'error' => $firstCategory->errors()->messages()
            ], 404);
        }
    }

    // second category
    public function secondCategory()
    {
        $secondCategory = categories::select('name')->skip(1)->first();
        if ($secondCategory) {
            return response()->json($secondCategory);
        } else {
            return response()->json([
                'error' => $secondCategory->errors()->messages()
            ], 404);
        }
    }

    // third category
    public function thirdCategory()
    {
        $thirdCategory = categories::select('name')->skip(2)->first();
        if ($thirdCategory) {
            return response()->json($thirdCategory);
        } else {
            return response()->json([
                'error' => $thirdCategory->errors()->messages()
            ], 404);
        }
    }

    // select all videos
    public function allVideos()
    {
        $videos = DB::table('videos')
            ->join('categories', 'videos.category_id', '=', 'categories.id')
            ->join('genres', 'videos.genres_id', '=', 'genres.id')
            ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
            ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
            ->select('videos.id', 'videos.title', 'videos.thumbnail', 'genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')
            ->orderBy('id', 'desc')
            ->where("videos.status", 1)->inRandomOrder()->limit(8)->get();

        if (!$videos) {
            return response()->json([
                'error' => $videos->errors()->messages()
            ], 404);
        } else {
            return response()->json($videos);
        }
    }

    // select videos based on rating
    public function allVideosByRating()
    {
        $videos = DB::table('videos')
            ->join('categories', 'videos.category_id', '=', 'categories.id')
            ->join('genres', 'videos.genres_id', '=', 'genres.id')
            ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
            ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
            ->select('videos.id', 'videos.title', 'videos.thumbnail', 'genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')
            ->orderBy('id', 'desc')
            ->where("videos.status", 1)
            ->where("videos.rating_id", 1)
            ->inRandomOrder()->limit(8)->get();


        return response()->json($videos);
    }

    // NOTE: This function, come back and remove the static category and status values
    public function allVideosByCategory()
    {
        $videos = DB::table('videos')
            ->join('categories', 'videos.category_id', '=', 'categories.id')
            ->join('genres', 'videos.genres_id', '=', 'genres.id')
            ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
            ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
            ->select('videos.id', 'videos.title', 'videos.thumbnail', 'genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')
            ->orderBy('id', 'desc')
            ->where("videos.status", 1)
            ->where("videos.category_id", 1)
            ->inRandomOrder()->limit(8)->get();
        if (!$videos) {
            return response()->json([
                'error' => $videos->errors()->messages()
            ], 404);
        } else {
            return response()->json($videos);
        }
    }

    // fetch a video with id, category, genres, rating and parent_control
    // used this function to set the number of view for each video
    public function playVideo($id)
    {
        $video = DB::table('videos')
            ->join('categories', 'videos.category_id', '=', 'categories.id')
            ->join('genres', 'videos.genres_id', '=', 'genres.id')
            ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
            ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
            ->select('videos.*', 'genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')
            ->orderBy('id', 'desc')
            ->where("videos.id", $id)->get();

        if ($video) {
            // if video was found increment the number of views
            DB::table('videos')->where('id', $id)->increment('views');

            return response()->json($video);
        } else {
            return response()->json([
                'error' => $video->errors()->messages(),
            ], 404);
        }
    }

    //  intended for displaying list of thumbnails as carousel(not used yet)
    public function BannerThumbnail()
    {
        $videoThumbnail = Videos::select("id", "title", "thumbnail")
            ->latest()
            ->get();
        return response()->json($videoThumbnail);
    }

    // fetch all payment plans
    public function paymentPlan()
    {
        $paymentPlans = PaymentPlan::where('status', 1)->latest()->get();

        if ($paymentPlans) {
            return response()->json($paymentPlans);
        } else {
            return response()->json([
                'error' => $paymentPlans->errors()->messages()
            ], 404);
        }
    }

    public function savePayment(Request $request)
    {
        // $validation = Validator::make($request, [
        //     'userId'               => 'required',
        //     'paymentPlanId'        => 'required',
        //     'duration'             => 'required',
        //     'amount'               => 'required',
        //     'transactionReference'      => 'required|unique:ActivePlans'
        // ]);

        // if ($validation->fails()) {
        //     return response()->json(['error' => $validation->errors()], 400);
        // }
        $expired_at             = 1;
        $userId                 = (int) $request->userId;
        $paymentPlanId          = (int) $request->paymentPlanId;
        $duration               = $request->duration;
        $amount                 = $request->amount;
        $transaction_reference  = $request->transactionReference;
        $payment_type           = $request->payment_type;

        // find user and update payment plan
        $user = User::where('id', $userId)->update([
            'subscription_id' => $paymentPlanId,
            'subcribe_date'   => Carbon::now(),
        ]);
        if (!$user) {
            return response()->json([
                'error' => $user->errors()->messages()
            ], 404);
        }

        $active_plan = new ActivePlans();
        $active_plan->userId       = $userId;
        $active_plan->paymentPlanId = $paymentPlanId;
        $active_plan->duration      = $duration;
        $active_plan->expired_at            = $expired_at;
        $active_plan->transaction_reference = $transaction_reference;
        $active_plan->payment_type          = $payment_type;
        $active_plan->amount                = $amount;
        $saved_active_plan = $active_plan->save();

        if ($saved_active_plan) {
            return response()->json($saved_active_plan);
        } else {
            return response()->json([
                'error' => $active_plan->errors()->messages()
            ], 500);
        }
    }

    // fetch active user plan
    public function userActivePlan($id)
    {
        $active_user_plan = DB::table('users')
            ->join('active_plans', 'users.subscription_id', '=', 'active_plans.paymentPlanId')
            ->join('payment_plans', 'active_plans.paymentPlanId', '=', 'payment_plans.id')

            ->select(
                'active_plans.created_at',
                'active_plans.transaction_reference',
                'payment_plans.name',
                'payment_plans.duration_in_name',
                'payment_plans.amount'
            )
            ->where('users.id', $id)
            ->get();
        if ($active_user_plan) {
            return response()->json($active_user_plan);
        } else {
            return response()->json([
                'error' => $active_user_plan->errors->messages(),
            ], 404);
        }
    }

    // video likes
    public function VideoLikes(Request $request)
    {
        $videoId = $request->videoId;
        $userId = $request->userId;


        $video = Videos::find($videoId);
        $user = User::find($userId);

        $likes = DB::table('likes')
            ->where('user_id', $user->id)
            ->where('video_id', $video->id)
            ->first();

        if ($likes) {
            return response()->json([
                'message' => 'You have already liked this video.'
            ], 400);
        }

        DB::table('likes')->insert(['user_id' => $user->id, 'video_id' => $video->id]);
        $video->likes += 1;
        $video->save();

        return response()->json([
            'likes' => $video->likes,
        ]);
    }
    public function VideoDislikes($id)
    {
        $video = videos::find($id);
        if ($video->likes > 0) {
            $video->likes -= 1;
            $video->save();
        } else {
            return response()->json([
                'message' => 'Cannot decrease dislike count below 0.',
            ]);
        }

        return response()->json([
            'likes' => $video->likes,
        ]);
    }
}

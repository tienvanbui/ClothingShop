<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getListNotification(Request $request)
    {
        $user = User::whereHas('role', function ($query) {
            $query->where('role_name','admin');
        })->first();
        if (!$user) {
            return $this->sendErrorResponse(__('Người dùng không tồn tại!.'));
        }
        $notifications = $user->notifications()
            ->latest()
            ->limit(10)
            ->get();

        return $this->sendSuccessResponse([
            'notifications' => NotificationResource::collection($notifications),
            'notifications_unread' => $user->unreadNotifications()->count(),
        ]);
    }

    /**
     * Summary of markNotification
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function markNotification(Request $request)
    {
        $user = User::whereHas('role', function ($query) {
            $query->where('role_name','admin');
        })->first();
        $user->unreadNotifications
            ->when($request->get('id'), function ($query) use ($request) {
                return $query->where('id', $request->get('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }
}

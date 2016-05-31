<?php

namespace App\Listeners;

use App\Events\UserUseCouponEvent;
use App\Models\Coupon;
use App\Models\CouponUserUse;

class UserUsedCouponListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    private $event;

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  UserUseCouponEvent  $event
     * @return void
     */
    public function handle(UserUseCouponEvent $event)
    {
        $this->event = $event;
        //Track the coupon used times of this user
        if ($this->event->coupon && $this->event->user) {
            $this->_userUsedCoupon();
            $this->_userUsedCouponWithTrackedTimes();
        }
    }

    private function _userUsedCoupon()
    {
        $object = new CouponUserUse();
        $object->coupon_id = $this->event->coupon->id;
        $object->user_id = $this->event->user->id;
        $object->save();
    }

    private function _userUsedCouponWithTrackedTimes()
    {
        $object = CouponUserUse::findByFieldsOrCreate([
            'coupon_id' => $this->event->coupon->id,
            'user_id' => $this->event->user->id,
        ]);
        $object->total_used = (int) $object->total_used++;
        $object->save();
    }
}

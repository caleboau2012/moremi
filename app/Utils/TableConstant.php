<?php
/**
 * Created by PhpStorm.
 * User: moscoworld
 * Date: 4/11/17
 * Time: 11:17 PM
 */
class TableConstant{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
    const ID = 'id';
    const USER_ID = 'user_id';
    const PROFILE_ID = 'profile_id';
    const STATUS = 'status';
}

class ProfileConstant{
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const VOTE = 'vote';
    const FACEBOOK = 'facebook_id';
    const SEX = 'sex';
    const PHOTO = 'photo_id';
    const ABOUT = 'about';
}

class OldCheekConstant{
    const WON_DATE = 'won_date';
    const WON_PHOTO = 'won_photo';
    const FACEBOOK_POST = 'facebook_post_id';
    const VOTER = 'voter_id';

}

class ConnectionConstant{
    const RECIPIENT_ID = 'recipient_id';
    const NAME = 'name';
    const PHOTO = 'photo';
    const MESSAGES = 'messages';
}
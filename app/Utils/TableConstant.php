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

    const MALE = 'male';
    const FEMALE = 'female';
}

class OldCheekConstant{
    const WON_DATE = 'won_date';
    const WON_PHOTO = 'won_photo';
    const FACEBOOK_POST = 'facebook_post_id';
    const VOTER = 'voter_id';
    const VOTES = 'votes';
}

class ConnectionConstant{
    const RECIPIENT_ID = 'recipient_id';
    const NAME = 'name';
    const PHOTO = 'photo';
    const MESSAGES = 'messages';
}

class TicketConstant{
    const CODE = 'code';
    const VENUE_ID = 'venue_id';
}

class VotingConfigConstant{
    const STARTED_AT = 'started_at';
    const TERMINATED_AT = 'terminated_at';
}
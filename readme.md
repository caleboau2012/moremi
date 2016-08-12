# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)


##HOW TO LOGIN
Post url : Local Host  http://localhost/moremi/public/login   Live Url http://site/login
Post Params  {'first_name': 'FIRST NAME HERE',
            'last_name' : 'LAST NAME HERE',
            'facebook_id': 'FACEBOOK ID',
            'email' :'EMAIL REQUIRED'}

## HOW TO UPLOAD PHOTO
Post url : Local Host  http://localhost/moremi/public/photo   Live Url http://site/photo
Post Params {pofile_id:100,photo:file}


 ##The response will be like this
   {
               "status": true,
               "message":"Authentication successful",
               "user": {
                 "first_name": "Samuel",
                 "last_name": "James",
                 "phone": "08138671141",
                 "facebook_id": "1234567890",
                 "email": "samuel@samuelabiodun.com",
                 "updated_at": "2016-06-12 15:12:37",
                 "created_at": "2016-06-12 15:12:37",
                 "id": 1
               },
               "authToken": "ILBKD+Ma6zU9/saK06ZDGAzBb9QdF0NeNw1Z0p2EG2CRK8f4izI60uilm8A4oRg4d3EfOeAaEhIKhzfpYDVt56"
             }

## To upload photo authentication is required

Request header takes {"authToken":"ILBKD+Ma6zU9/saK06ZDGAzBb9QdF0NeNw1Z0p2EG2CRK8f4izI60uilm8A4oRg4d3EfOeAaEhIKhzfpYDVt56"}
Input param {"photo":"file"}
For unauthenticated user
{'status':false, 'message'=>'authentication is required!'}

## To vote photo - No authentication is required
Url: http://localhost/moremi/public/vote
Request parameter - {"profile_id":1}
Success response {'status'=>true,'Profile photo successfully'}
Error response {'status'=>false,'You can not vote this profile again until after two days'}

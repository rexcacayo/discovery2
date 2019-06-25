<?php

function getUserAvatar()
{
	$userAvatar = auth()->user() ?
					auth()->user()->{config('redprintUnity.auth_user_avatar_field')} :
					'';
	
	return $userAvatar ?: asset(config('redprintUnity.default_avatar'));
}

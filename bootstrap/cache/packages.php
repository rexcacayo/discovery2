<?php return array (
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'laravel/nexmo-notification-channel' => 
  array (
    'providers' => 
    array (
      0 => 'Illuminate\\Notifications\\NexmoChannelServiceProvider',
    ),
  ),
  'laravel/slack-notification-channel' => 
  array (
    'providers' => 
    array (
      0 => 'Illuminate\\Notifications\\SlackChannelServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'maatwebsite/excel' => 
  array (
    'providers' => 
    array (
      0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
    'aliases' => 
    array (
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'rachidlaasri/laravel-installer' => 
  array (
    'providers' => 
    array (
      0 => 'RachidLaasri\\LaravelInstaller\\Providers\\LaravelInstallerServiceProvider',
    ),
  ),
  'shah-newaz/codecanyon-license' => 
  array (
    'providers' => 
    array (
      0 => 'Shahnewaz\\CodeCanyonLicensor\\Providers\\LicenseServiceProvider',
    ),
    'aliases' => 
    array (
      'Licensor' => 'Shahnewaz\\CodeCanyonLicensor\\Facades\\Licensor',
    ),
  ),
  'shah-newaz/permissible' => 
  array (
    'providers' => 
    array (
      0 => 'Shahnewaz\\Permissible\\Providers\\PermissibleServiceProvider',
    ),
    'aliases' => 
    array (
      'Permissible' => 'Shahnewaz\\Permissible\\Facades\\PermissibleFacade',
    ),
  ),
  'shah-newaz/redprint' => 
  array (
    'providers' => 
    array (
      0 => 'Shahnewaz\\Redprint\\Providers\\RedprintServiceProvider',
      1 => 'Shahnewaz\\Redprint\\Providers\\RedprintshipServiceProvider',
    ),
    'aliases' => 
    array (
      'Redprint' => 'Shahnewaz\\Redprint\\Facades\\RedprintFacade',
      'Redprintship' => 'Shahnewaz\\Redprint\\Facades\\RedprintshipFacade',
    ),
  ),
  'shah-newaz/redprint-unity' => 
  array (
    'providers' => 
    array (
      0 => 'Shahnewaz\\RedprintUnity\\ServiceProvider',
    ),
  ),
  'tymon/jwt-auth' => 
  array (
    'aliases' => 
    array (
      'JWTAuth' => 'Tymon\\JWTAuth\\Facades\\JWTAuth',
      'JWTFactory' => 'Tymon\\JWTAuth\\Facades\\JWTFactory',
    ),
    'providers' => 
    array (
      0 => 'Tymon\\JWTAuth\\Providers\\LaravelServiceProvider',
    ),
  ),
);
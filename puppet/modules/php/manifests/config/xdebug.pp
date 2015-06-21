class php::config::xdebug {

  # setup xdebug
  file { '/etc/php5/mods-available/xdebug.ini':
    source   => 'puppet:///modules/php/xdebug.ini',
    require  => Package['apache2', 'libapache2-mod-php5', 'php5-cli'],
  }

  exec { 'php5enmod xdebug':
    path        => '/bin:/usr/bin:/usr/sbin/',
    cwd         => '/root/',
    command     => 'php5enmod xdebug',
    user        => root,
    notify   => Service['apache2'],
    require  => File['/etc/php5/mods-available/xdebug.ini'],
  }
}

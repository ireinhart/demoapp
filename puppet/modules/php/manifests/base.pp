class php::base {

  user { 'vagrant':
    ensure => 'present',
  }

  file { '/home/vagrant/bin':
    ensure  => 'directory',
    owner   => 'vagrant',
    group   => 'vagrant',
    mode    => '755',
    require => User['vagrant'],
  }
}

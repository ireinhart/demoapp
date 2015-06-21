class apache2::service {

  service { $apache2::params::sname:
      ensure     => 'running',
      enable     => true,
      hasstatus  => true,
      hasrestart => true,
      require    => [ Class['apache2::install'],
                      Class['apache2::config'],
                   ],
  }

}

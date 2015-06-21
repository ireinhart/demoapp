define apache2::module ( $modulname = $title,
                         $ensure,
                        ) {

  Exec { path => '/usr/bin:/bin:/usr/sbin:/sbin' }

  case $ensure {
      'present': {
          exec { "a2enmod $modulname":
              unless  => "test -f $apache2::params::apache2_mods-enabled/$modulname.load",
              require => Class['apache2::install'],
              notify  => Service[$apache2::params::sname],
          }
      }

      'absent': {
          exec { "a2dismod $modulname":
              onlyif  => "test -f $apache2::params::apache2_mods-enabled/$modulname.load",
              require => Class['apache2::install'],
              notify  => Service[$apache2::params::sname],
          }
      }

      default: { fail("Unknown variable ensure: $ensure")  }
  }

  include 'apache2::service'

}

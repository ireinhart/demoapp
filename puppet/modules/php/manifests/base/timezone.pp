class php::base::timezone {

  file {
    '/etc/php/':
      content => 'Europe/Berlin\n',
  }

}

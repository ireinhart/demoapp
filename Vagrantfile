VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.hostname = "demoapp.dev"
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network "forwarded_port", guest: 143, host: 8143
  config.vm.network :private_network, ip: "10.11.12.13"

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "2056"]
    vb.customize ['modifyvm', :id, '--natdnshostresolver1', 'on']
  end

  config.vm.synced_folder "./", "/vagrant", id: "vagrant", :nfs => true, mount_options: ['nolock', 'rw', 'tcp', 'fsc', 'actimeo=2']

  config.vm.provision "puppet" do |puppet|
    puppet.hiera_config_path = "puppet/hieradata/verify/hiera_vagrant.yaml"
    puppet.manifests_path = "puppet/manifests"
    puppet.module_path = "puppet/modules"
    puppet.manifest_file = "site.pp"
  end
end

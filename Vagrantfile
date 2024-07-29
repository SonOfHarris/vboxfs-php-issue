#!/usr/bin/env ruby
# frozen_string_literal: true

# -*- mode: ruby -*-

require 'fileutils'

Vagrant.require_version '>= 2.0.0'

CENTOS_BOX_VERSION = '20240724.0'

# Shared folder setup
export_base = "#{ENV['USERPROFILE']}"
vagrantshare = File.join('.', 'code')

Vagrant.configure('2') do |config|
  config.vm.define "vboxfs-php-issue"

  # Metadata is not available via vagrant so need to reference specific release
  config.vm.box = "centos/stream9_#{CENTOS_BOX_VERSION}"
  config.vm.box_url = "https://cloud.centos.org/centos/9-stream/x86_64/images/CentOS-Stream-Vagrant-9-#{CENTOS_BOX_VERSION}.x86_64.vagrant-virtualbox.box"
  config.vm.box_check_update = false

  config.vm.provider 'virtualbox' do |v|
    v.name = 'vboxfs-php-issue'

    v.gui = true

    v.customize ["modifyvm", :id, "--audio", "none"]

    if Vagrant.has_plugin?("vagrant-vbguest")
      config.vbguest.auto_update = true
    end
  end

  config.vm.provision "shell", inline: <<-SHELL
    # Add PHP 8.3
    dnf config-manager --set-enabled crb
    dnf install epel-release epel-next-release -y
    rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-9
    dnf install dnf-utils http://rpms.remirepo.net/enterprise/remi-release-9.rpm -y
    dnf update --refresh

    # Update everything
    dnf upgrade -y

    # Dependencies
    dnf install wget zip -y

    # PHP 8.3
    dnf module reset php
    dnf install php83 php83-php-pecl-mcrypt php83-php-pecl-zip -y
    echo "source /opt/remi/php83/enable" > /etc/profile.d/php.sh

    # Composer
    wget https://getcomposer.org/installer -O composer-installer
    source /opt/remi/php83/enable
    php composer-installer --install-dir=/usr/local/bin --filename=composer
    rm composer-installer
  SHELL

  # Disable default /vagrant folder
  config.vm.synced_folder '.', '/vagrant', disabled: true

  # Code
  config.vm.synced_folder vagrantshare, '/srv/code',
    id: 'code',
    owner: 'vagrant'
end

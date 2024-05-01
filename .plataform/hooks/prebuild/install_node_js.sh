#!/bin/sh
if [[ ! "$(node - version)" =~ "v16" ]]; then
sudo yum install -y gcc-c++ make
sudo yum remove -y nodejs npm
sudo rm -rf /var/cache/yum/*
sudo yum clean all
curl -sL https://rpm.nodesource.com/setup_16.x | sudo -E bash -
sudo yum install -y nodejs
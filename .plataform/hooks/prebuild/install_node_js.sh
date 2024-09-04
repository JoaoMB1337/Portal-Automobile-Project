#!/bin/sh

# Check if the installed Node.js version is not 20
if ! node -v | grep -q "v20"; then
    # Install necessary build tools
    sudo yum install -y gcc-c++ make

    # Remove existing Node.js and npm
    sudo yum remove -y nodejs npm

    # Clean up yum cache
    sudo rm -rf /var/cache/yum/*
    sudo yum clean all

    # Set up Node.js 20.x repository
    curl -fsSL https://rpm.nodesource.com/setup_20.x | sudo bash -

    # Install Node.js 20.x
    sudo yum install -y nodejs

    # Optionally install nsolid if needed
    # sudo yum install -y nsolid
fi

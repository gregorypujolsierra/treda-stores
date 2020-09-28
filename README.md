
## Get started

- Install Homestead and setup Vagrant: https://laravel.com/docs/8.x/homestead

- Add project to Homestead.yaml
```
    folders:
           - map: ~/DevelopmentProjects/tests/Treda
             to: /home/vagrant/treda
    sites:
           - map: treda-stores
             to: /home/vagrant/treda/treda-stores/public
```

- Add to local hosts: `sudo vim /etc/hosts`

- Create 'treda_stores' database (into vagrant@homestead:~):
```
mysql> create database treda_stores;
```
    
- Install dependencies and compile:
```
vagrant@homestead:~/treda/treda-stores$ composer install
vagrant@homestead:~/treda/treda-stores$ npm install
vagrant@homestead:~/treda/treda-stores$ npm run dev
```

- And reload Vagrant:
```:~/Homestead$ vagrant reload --provision```

## Running project

- Run the virtual machine: 
```:~/Homestead$ vagrant up```

- Open `treda-stores/` in the browser

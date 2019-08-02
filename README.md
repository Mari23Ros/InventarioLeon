# Instalacion por primera vez

  

1. Instalar virtual box

2. Instalar vagrant

3. Instalar composer

4. Correr 'composer global require "laravel/installer"'

5. Correr 'vagrant box add laravel/homestead'

6. Correr 'git clone https://github.com/laravel/homestead.git ~/Homestead'

7. Ubicarse en el Homestead Directory y correr el archivo 'init.bat'

8. Agregar los archivos en Homestead.yaml con la ruta del sitio y de la bdd

9. Anadir la direccion puesta en el archivo .yaml en C:\Windows\System32\drivers\etc\hosts'

ejemplo '192.168.10.10 myproject.test'

10. Crear el proyecto en la ruta del map

11. En el terminarl ir a la carpeta ~/Homestead

12. correr 'vagrant up'

13. correr 'vagrant provision'

14. correr 'vagrant ssh' para comprobar

15. acceder a la direccion

  

### EJEMPLO: 
En la directiva folders:

* map: la carpeta de tu pc donde estaran tus proyectos

* to: dejarlo como esta

```

- map: C:\ProyectosLaravel (aqui crear el proyecto 'laravel new myproject')

to: /home/vagrant/code
```
  
```
sites:

- map: myproject.test

to: /home/vagrant/code/myproject/public

  ```
  

# Cada vez que se cree un proyecto adicional

1. crear proyecto en c/laravel-projects

2. editar el archivo .env con el nombre de la ruta

3. agregar el mapeo en el .yaml de Homestead

5. agregar la ruta en hosts

6. al subir la maquina virtual correr el 'vagrant provision'

7. probar la ruta

  

### NOTA: 
apagar la maquina virtual con vagrant halt

o vagrante suspend para suspenderlo

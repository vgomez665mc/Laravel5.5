<!--

-----------------------------------****Relaciones entre tablas***---------------------------------

*****************************************Relacion One to One*************************************


**********************************************Pasos**********************************************
Paso1: crear los modelos con sus tablas para ello emplear el comando
comando:php artisan make:model Cliente --migration
Paso2: creas los campos que necesitas con sus respectivas claves foraneas y luego presionas el siguiente comando.
comando: php artisan migrate
Paso3:te diriges a la al modelo de la tabla a referenciar y colocas lo siguiente:
ejemplo de tabla: Cliente(id,nombre,apellido) articulos(id,cliente_id,nombre,precio)
Nota: aqui la relacion es dame los clientes que tengan un articulo

tienes que crear una funcion con el nombre del modelo de la tabla donde esta la foreing key y hacer lo siguiente

class Cliente extends Model
{
    public function articulo(){
        return $this->hasOne("App\Articulo");
    }

paso 4: ya con eso esta listo,puedes ir al archivo web y crear una ruta de prueba
Route::get('cliente/{id}/articulo',function($id){
    return \App\Cliente::find($id)->articulo;
});


*****************************************Inverse Of The Relationship******************************


**********************************************Pasos**********************************************

Paso1: en el modelo de la tabla contraria en este caso  de la tabla articulo se crea la funcion cliente y se coloca lo siguiente:

public function cliente(){
        return $this->belongsTo('App\Cliente');
        
    }

Paso 2: ya con las tablas creadas y todo listo se prueba la consulta invirtiendo la anterior .

Route::get('articulo/{id}/cliente',function($id){
    return \App\Articulo::find($id)->cliente;
});

si quieres un campo en especifico,buscas el que quieres mostrar

Route::get('articulo/{id}/cliente',function($id){
    return \App\Articulo::find($id)->cliente->Nombre;
});

**************************************One To Many***********************************


**********************************************Pasos**********************************************

Paso1:colocar en el modelo de la tabla a referencia la siguiente funcion el nombre de la funcion es en plural

public function comments()
    {
        return $this->hasMany('App\Comment');
    }

paso 2: para pobrar la relacion se aplica el siguiente codigo

*************************************Many To Many***********************************


**********************************************Pasos**********************************************


Paso1: crear las tablas con sus modelos empleando el comando
comando: php artisan make:model Perfil -m 

Paso:2 en los archivos correspondientes crear los campos

Paso3: Crear la tabla pivot que es creando el archivo migration usando el siguiente comando
comando: php artisan make:migration create_cliente_perfils_table --create="cliente_perfil"

mantener la convencion de iniciar con la palabra create, luego el nombre de la primera tabla segun
el alfabaeto luego la segunda tabla y por ultimo table, en el create lo mismo primero la tabla por orden alfabetico y luego la otra


Paso4: crear los campos clave_id de las tablas que refencian en el archivo migration pivot,igual
colocar lo en orden alfabetico

 public function up()
    {
        Schema::create('cliente_perfil', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("cliente_id");
            $table->integer("perfil_id");
            $table->timestamps();
        });
    }

Paso 5: luego de tener todos los datos agregados en las tablas aplicar lo cambios empleando el comando:
comando: php artisan migrate

paso 6: en el modelo cliente colocar lo siguiente de la otra tabla

public function perfils()
    {
        return $this->belongsToMany('App\Perfil');
    }

la funcion debe tener el nombre de la otra tabla en plural, y en la ruta colocar el nombre del modelo de la otra tabla .

Paso 7: probar que todo esta bien aplicando la siguiente ruta:

Route::get('cliente/{id}/perfil',function($id){
    $clientes = Cliente::find($id);

    foreach ($clientes->perfils as $perfil) {
        return $perfil->Nombre;
        
    }
});


en el foreach se coloca el nombre de la funcion que se declaro en en el modelo









***************************************************************************************************








---------como crear una llave foranea luedo de crear la  tabla----
Pasos:

 Paso 1: creas la migracion correpondiente a la tabla donde añadiras la nueva columna
    php artisan make:migration add_cliente_id_to_articulos
    seleccion el nombre de la clave y la tabla donde la crearas

Paso 2:  te diriges al archivo de migracion creado y copias lo siguiente:

  public function up()
    {
        Schema::table('articulos', function (Blueprint $table) {

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

        });

    }

    /**
     * Reverse the migrations.
     *
     */
    public function down()
    {
            Schema::table('articulos', function (Blueprint $table) {
                 $table->dropColumn('cliente_id');


            });

    }

 Paso:3 ejecutas el comando php artisan migrate y se cargara la nueva migracion creada y se añadira la columna
 si da error aplicar el comando php artisan migrate:refresh pero te borrara todas las tablas y creara nuevamente las tablas



-------------------para crear una llave foranea al crear una tabla-------------

Luego de crear el modelo y la migracion de la tabla creas los siguientes campos:


    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cliente_id')
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->string('Nombre');
            $table->string('Apellido');
            $table->timestamps();
        });
    }









-->
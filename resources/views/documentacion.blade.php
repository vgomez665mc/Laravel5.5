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
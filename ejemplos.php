<?php
public function setImageAttribute($value){
        $attribute_name = "image";
        // or use your own disk, defined in config/filesystems.php
        // o use su propio disco, definido en config / filesystems.php
        $disk = 'uploads';
        // destination path relative to the disk above
        // ruta de destino relativa al disco de arriba
        $destination_path = "/public";

        // if the image was erased
        // si la imagen fue borrada
        if ($value==null) {
            // delete the image from disk
            // eliminar la imagen del disco
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            // establecer nulo en la columna de la base de datos
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        // si se envió un base64, guárdelo en la base de datos
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            // 0. Haz la imagen
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            // 1. Genere un nombre de archivo.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            // 2. Almacene la imagen en el disco.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            // Elimina la imagen anterior, si la hubiera.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
            // 4. Guarde la ruta pública a la base de datos
            // but first, remove "public/" from the path, since we're pointing to it
            // pero primero, elimine "public /" de la ruta, ya que lo estamos apuntando
            // from the root folder; that way, what gets saved in the db
            // desde la carpeta raíz; de esa manera, lo que se guarda en la base de datos
            // is the public URL (everything that comes after the domain name)
            // es la URL pública (todo lo que viene después del nombre de dominio)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $filename;
        }
    }

 ?>











**calendar

<template>
    <div class="vx-card no-scroll-content">
      <div class="vx-row">
          <!-- COL 1 -->
          <div class="vx-col w-full lg:w-1/4">
              <!-- ABOUT CARD -->
              <vx-card title="About" class="mt-base">
                  <!-- ACTION SLOT -->
                  <template slot="actions">
                      <feather-icon icon="MoreHorizontalIcon"></feather-icon>
                  </template>

                  <!-- USER BIO -->
                  <div class="user-bio">
                      <p>Tart I love sugar plum I love oat cake. Sweet roll caramels I love jujubes. Topping cake wafer.</p>
                  </div>

                  <!-- OTEHR DATA -->
                  <div class="mt-5">
                      <h6>Joined:</h6>
                      <p>November 15, 2015</p>
                  </div>

                  <div class="mt-5">
                      <h6>Lives:</h6>
                      <p>New York, USA</p>
                  </div>

                  <div class="mt-5">
                      <h6>Email:</h6>
                      <p>bucketful@fiendhead.org</p>
                  </div>

                  <div class="mt-5">
                      <h6>Website:</h6>
                      <p>www.pixinvent.com</p>
                  </div>

                  <div class="social-links flex mt-4">
                      <feather-icon svgClasses="h-7 w-7 cursor-pointer bg-primary p-1 text-white rounded" class="mr-2" icon="FacebookIcon"></feather-icon>
                      <feather-icon svgClasses="h-7 w-7 cursor-pointer bg-primary p-1 text-white rounded" class="mr-2" icon="TwitterIcon"></feather-icon>
                      <feather-icon svgClasses="h-7 w-7 cursor-pointer bg-primary p-1 text-white rounded" class="mr-2" icon="InstagramIcon"></feather-icon>
                  </div>
              </vx-card>


          </div>

          <!-- COL 2 -->
          <div class="vx-col w-full lg:w-3/4">
              <vx-card class="mt-base" title="Nueva Compra">
                  <div>
                      <!-- POST HEADER -->

                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>First Name</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <vs-input class="w-full" v-model="input1" />
                        </div>
                      </div>
                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>Email</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <vs-input class="w-full" type="email" v-model="input2" />
                        </div>
                      </div>
                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>Mobile</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <vs-input class="w-full" v-model="input3" />
                        </div>
                      </div>
                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>Password</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <vs-input class="w-full" type="password" v-model="input4" />
                        </div>
                      </div>
                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-2/3 w-full ml-auto">
                          <vs-checkbox class="inline-flex" v-model="check1">Remember Me</vs-checkbox>
                        </div>
                      </div>
                      <div class="vx-row">
                        <div class="vx-col sm:w-2/3 w-full ml-auto">
                          <vs-button class="mr-3 mb-2">Submit</vs-button>
                          <vs-button color="warning" type="border" class="mb-2" @click="input1 = input2 = input3 = input4 = input4 = ''; check1 = false;">Reset</vs-button>
                        </div>
                      </div>


                  </div>
              </vx-card>
          </div>


      </div>
    </div>



    <!-- EDIT EVENT -->

</template>

<script>


export default {
  components: {

  },
  data () {
    return {

    }
  },
  computed: {

  },
  methods: {

  },
  created () {

  },
  beforeDestroy () {

  }
}
</script>

<style lang="scss">
// @import "@sass/vuexy/apps/simple-calendar.scss";
</style>

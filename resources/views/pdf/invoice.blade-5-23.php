<style type="text/css">

  .col-md-center {

    text-align: center;

  }





  .excel-wrap {

    background:   white;

    padding:  20px 50px;

    width: 70%;

    margin: auto;

  }

  .excel-wrap .title  {

    border-bottom: 2px solid black;

  }



  .border-bottom {

    border-bottom: 1px solid #eee;

  }



  .margin-bottom-20 {

    margin-bottom: 20px;

  }



  .excel-wrap .row {

    margin-bottom : 20px;

  }



  .excel-wrap > div > div> div >input {

    margin-bottom: -1px;

    border-color: #eee;

    border-bottom: none;



  }



  .width-100 {

    width: 100%;

  }



  .excel-wrap > div > div> div> textarea {

    border-color: #eee;

  }



  .padding-bottom {

    padding-bottom: 10px; 

  }



  .form-control[readonly] {

    background-color: white; 

  }



  .col-md-2 { display: inline-block }



  .form-control {

    display: block;

    width: 100%;

    height: calc(2.25rem + 2px);

    padding: .375rem .75rem;

    font-size: 1rem;

    line-height: 1.5;

    color: #495057;

    background-color: #fff;

    background-clip: padding-box;

    border: 1px solid #ced4da;

    border-radius: .25rem;

  }



</style>

<div class="container  excel-wrap">
    <div class="row title"> 
     <img style="left:10px;width: 100%;" src="{{ asset('images/itt.jpg') }}"/>
    </div>
    <div class="row title">
    </div>
    <div class="row title"> 

      <h2 class="col-md-center">SERVICIO FLETADO (c.f.s.)</h2>

    </div>

    

    <div class="row border-bottom ">

      <div class="col-md-10 ">

        <div class="col-md-2">

          Servicio: <!--transfer-->

        </div>

        <div class="col-md-2">

         {{$data[0]->transfer}}

        </div>

        <div class="col-md-2" style="margin-left: 34%;">

          {{$data[0]->TypeId}}


        </div>

        <div class="col-md-2">

          

        </div>

      </div>

    </div>



    <div class="row border-bottom ">

      <div class="col-md-12 padding-bottom">

        <div class="col-md-2">

          ORIGEN:

        </div>

        <div class="col-md-10" style="display: inline-block;">

          {{$data[0]->origin}}

        </div>

      </div>

    </div>



    <div class="row border-bottom padding-bottom">

      <div class="col-md-12"> 

        <div class="col-md-2">

          DESTINO:

        </div>

        <div class="col-md-10" style="display: inline-block;">

          {{$data[0]->destination}}

        </div>

      </div>

    </div>



    <div class="row  ">

        <div class="col-md-4 border-bottom padding-bottom" style="display: inline-block;">

          <div class="col-md-2">FECHA:</div>

          <div class="col-md-2">

            {{$data[0]->BTDate}}

          </div>

        </div>

       

        <div class="col-md-4 border-bottom padding-bottom" style="display: inline-block; margin-left: 50%;">

          <div class="col-md-2">

            HORA:

          </div>



          <div class="col-md-2">

            {{$data[0]->BTTime}}

          </div>

        </div>

    </div>



    <div class="row ">

      <div class="col-md-12">

        <div class="col-md-6">

          <span>IMPORTE(10% IVA INCLUIDO)</span>

        </div>



        <div class="col-md-6">

        

        </div>

      </div>

    </div>



    <div class="row">

      <div class="col-md-12">   

        <div class="col-md-4">

          <textarea rows="10" class="" style="width: 60%;">{{$data[0]->Price}}    

          </textarea>

        </div>

      </div>



    </div>



    <div class="row">

      <div class="col-md-12">

        <div class="col-md-6">

          <span>OBSERVACIONES:</span>

        </div>



        <div class="col-md-6">

          

        </div>

      </div>

    </div>



    <div class="row">

      <div class="col-md-12">   

        <div class="col-md-12">

          <textarea rows="10" class="width-100" style="width: 60%;">{{$data[0]->observation}}

          </textarea>

        </div>

      </div>



    </div>



    <div class="row">

      <div class="col-md-12">

      <div class="col-md-4" style="display: inline-block;">

        MATRICULA VEHICULO 

      </div>

      <div class="col-md-8" style="display: inline-block;">

        {{$data[0]->carnumber}}

      </div>

      </div>

    </div>

</div>
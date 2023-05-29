
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <style>
    .sucess_card{
      height: 100vh;
      border-radius: 5px;
      padding: 20px;
    }
    a{
      text-transform: uppercase;
      text-decoration: none;
      color: white;
      background: #3C2784;
      padding: 8px 15px;
      border-radius: 3px;
      font-size: 13px;
      cursor: pointer;
    }
    
  </style>
  <body>
    <div class="sucess_card d-flex flex-column justify-content-center">
      <div class="tick_logo text-center  mb-4">
        <i class=""></i>
        <i class="fa-solid fa-xmark border border-danger rounded-circle px-4 py-3 text-white fs-2 bg-danger "></i>
      </div>
      <div class="title_sucess  text-center fs-4 fw-normal" style="color:#696969;">
        <h1>Payment Failed!</h1>
      </div>
      <div class="payment_detail mb-3 mt-2 text-center " style="border-radius:3px">
        <p class="m-0 fw-bold">Your request Has been Failed</p>
        <p class="opacity-75" style="font-size: 14px;padding-inline: 90px;">Please reprocess your payment by going to your Profile section. <br> Thank you!</p>
      </div>
      <div class="btns text-center">
        <a href="{{route('dashboard')}}">Go To Dashborad</a>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

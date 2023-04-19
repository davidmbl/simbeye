<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Group 2 Task</title>
    <!-- FontAwesome Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('simbeye/styles.css') }}" />

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!-- Stylesheet -->
{{-- <link rel="stylesheet" href="{{ asset('simbeye/styles.css') }}" /> --}}

<style>
    :root {
    --bgColor: #121317;
    --my-containerBg: #21242b;
    --my-containerBottomColor: #18f9907e;
    --mainColor: #18f98f;
    --lightColor: #ebf1ea;
   }

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }
  body {
    background-color: var(--bgColor);
  }
  .wrapper {
    position: absolute;
    width: 80vw;
    transform: translate(-50%, -50%);
    top: 65%;
    left: 50%;
    display: flex;
    justify-content: space-around;
    gap: 10px;
  }
  .my-container {
    width: 28vmin;
    height: 28vmin;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    padding: 1em 0;
    position: relative;
    font-size: 16px;
    border-radius: 0.5em;
    background-color: var(--my-containerBg);
    border-bottom: 10px solid var(--my-containerBottomColor);
  }
  i {
    color: var(--mainColor);
    font-size: 2.5em;
    text-align: center;
  }
  span.num {
    color: #ffffff;
    display: grid;
    place-items: center;
    font-weight: 600;
    font-size: 2em;
  }
  span.text {
    color: #e0e0e0;
    font-size: 1em;
    text-align: center;
    pad: 0.7em 0;
    font-weight: 400;
    line-height: 0;
  }

  .head-content{
    /* position: absolute; */
    /* width: 80vw; */
    /* top: 10%; */
    padding-top: 10%;
    text-align: center;
    font-size: 1.2em;
    text-align: center;
    pad: 0.7em 0;
    font-weight: 400;
    line-height: 1.5;
  }

  .greetings{
    position: relative;
    /* width: 80vw; */
    top: 10%;
    /* left: 50%; */
    color: var(--lightColor);
    font-size: 1em;
    text-align: center;
    pad: 0.7em 0;
    font-weight: 400;
    line-height: 0;
  }

  .username{
    color: var(--mainColor);
    font-size: 1.3em;
  }
  .card-no{
    color: #e0e9e5;
    font-size: 1.6em;
  }

  @media screen and (max-width: 1024px) {
    .wrapper {
      width: 85vw;
    }
    .my-container {
      height: 26vmin;
      width: 26vmin;
      font-size: 12px;
    }
  }
  @media screen and (max-width: 768px) {
    .wrapper {
      width: 90vw;
      flex-wrap: wrap;
      gap: 30px;
    }
    .my-container {
      width: calc(50% - 40px);
      height: 30vmin;
      font-size: 14px;
    }
  }
  @media screen and (max-width: 480px) {
    .wrapper {
      gap: 15px;
    }
    .my-container {
      width: 100%;
      height: 25vmin;
      font-size: 8px;
    }
  }


/* No Card CSS */
.inputbox {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.inputbox input {
  position: relative;
  width: 100%;
  padding: 20px 10px 10px;
  background: transparent;
  outline: none;
  box-shadow: none;
  border: none;
  color: #23242a;
  font-size: 1em;
  letter-spacing: 0.05em;
  transition: 0.5s;
  z-index: 10;
}

.inputbox span {
  position: absolute;
  left: 0;
  padding: 20px 10px 10px;
  font-size: 0.9em;
  color: #8f8f8f;
  letter-spacing: 00.05em;
  transition: 0.5s;
  pointer-events: none;
}

.inputbox input:valid ~span,
.inputbox input:focus ~span {
  color: var(--mainColor);
  transform: translateX(-10px) translateY(-34px);
  font-size: 0,75em;
}

.inputbox i {
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 2px;
  background: var(--mainColor);
  border-radius: 4px;
  transition: 0.5s;
  pointer-events: none;
  z-index: 9;
}

.inputbox input:valid ~i,
.inputbox input:focus ~i {
  height: 44px;
}

.button-my-container {
    position: absolute;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 196px;
    /* position: relative;
    width: 196px; */
    /* margin-top: 20px; */
}

.checker{
    position: absolute;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: var(--mainColor);
}

button {
    position: relative;
    width: 100%;
    padding: 20px 10px 10px;
    background: transparent;
    outline: none;
    box-shadow: none;
    border: none;
    color: var(--mainColor);
    font-size: 1em;
    letter-spacing: 0.05em;
    transition: 0.5s;
    z-index: 10;
}

button:hover {
    background: var(--mainColor);
    color: #23242a;
}

/* button spinner */

.lds-dual-ring {
    display: inline-block;
    width: 80px;
    height: 80px;
  }
  .lds-dual-ring:after {
    content: " ";
    display: block;
    width: 64px;
    height: 64px;
    margin: 8px;
    border-radius: 50%;
    border: 6px solid #fff;
    border-color: #fff transparent #fff transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }
  @keyframes lds-dual-ring {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }

</style>
</head>
  <body>
    @yield('content')
    @livewireScripts
    {{-- bootstrap --}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="{{ asset('simbeye/js/app_admin.js') }}" defer></script>
<script src="{{ asset('simbeye/js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>

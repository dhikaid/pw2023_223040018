<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <style>
      .bungkus {
        display: flex;
      }
      .bungkus span {
        background-color: salmon;
        display: flex;
        width: 50px;
        height: 50px;
        border-style: solid;
        border-width: 1px;
        align-items: center;
        justify-content: space-around;
        /* margin: 4px;  */
      }
    </style>
  </head>

  <body>
    <div class="bungkus">
      <span>1</span>
    </div>
    <div class="bungkus">
      <span>2</span>
      <span>2</span>
    </div>
    <div class="bungkus">
      <span>3</span>
      <span>3</span>
      <span>3</span>
    </div>
  </body>
</html>

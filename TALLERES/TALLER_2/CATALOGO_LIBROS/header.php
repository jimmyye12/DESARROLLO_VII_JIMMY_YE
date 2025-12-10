<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Libros</title>
    <style>
        body { font-family: Arial;
             margin:0; padding:0; 
             background:#f4f4f9; 
             color:#333; }

        header { background:#4a76a8; 
            color:white; 
            padding:20px; 
            text-align:center; }

        .container { width:90%;
             margin:20px auto; 
             display:grid; 
             grid-template-columns:repeat(auto-fit, minmax(250px,1fr)); 
             gap:20px; }

        .libro { background:white;
             border-radius:8px;
              box-shadow:0 2px 5px rgba(0,0,0,0.1);
               padding:15px; 
               transition: transform 0.2s ease; }

        .libro:hover { transform:translateY(-5px); 
        }
        .libro h2 { font-size:18px;
            color:#4a76a8; 
            margin-bottom:10px; }

        .libro p { margin:5px 0;
             font-size:14px; }

        footer { background:#4a76a8;
             color:white; text-align:center;
              padding:10px;
               margin-top:30px; }
               
    </style>
</head>
<body>
<header>
    <h1>Catálogo de Libros</h1>
</header>
<main>
    <div class="container">

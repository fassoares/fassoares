<!DOCTYPE html>
<html lang="BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viwport" content="width=divice-width, inictial-scale=1.0">
        <link rel="stylesheet" href="{{BASE}}vendor/bootstrap/bootstrap.min.css"/>
        <title>
            {% block title}{%endblock%}
        </title>
    </head>
    <body>
        {% include 'partials/headear.twig.php%}
        {% block body %}{%endblock%}
    </body>
</html>
{{ get_doctype() }}
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{ renderTitle() }}
        {{ assets.outputCSS('header') }}

        <!-- <link rel="shortcut icon" type="image/x-icon" href="{{ url('img/favicon.ico') }}"/> -->
    </head>

    <body>
        {% block navbar %}
        {% if session.has('auth')%}
        {{ partial( 'partials/auth/navbar') }}
        {%- else -%}
        {{ partial( 'partials/guest/navbar')}}
        {% endif %} 
        {% endblock %}
        {% block content %} {% endblock %}
        {% include 'partials/footer.volt' %}


    </body>
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    {{ assets.outputJS('js') }}

</html>
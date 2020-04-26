{% extends 'subforum/index.volt' %}



{% block content %}
{{ super() }}
<div class="container">
    <div class="row-center ">
        <div class="col-md-auto bg-white ">
            <a href="/subforum/index">Browse Subforums >></a>
        </div>  
    </div>  
</div>
<div class="container mt-1">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-white">
            <div class="text-center">
                <table class="table table-hover">
                    <thead class="thead bg-primary text-white text-justify">
                        <tr>
                            <th scope="col" class="th "><h5>Subforums</h5></th>
                            <th scope="col"><h6>Threads</h6></th>
                            <th scope="col"><h6>Created</h6></th>
                            <th scope="col"><h6>Last Post</h6></th>
                        </tr>
                    </thead>
                    <tbody class="th text-center">
                        {% for subforum in subforums %}
                        <tr>
                            <th scope="row" class="th text-justify"> 
                                <div class="col-5 ">
                                        <a href="#"><h5>{{ subforum.name }}</h5></a> 
                                        <h6 class="text-muted text-truncate">{{ subforum.description }}</h6> 
                                </div>
                            </th>
                            <th scope="row"><h6>{{ subforum.threads }}</h6></th>
                            <th scope="row"></th>
                            <th scope="row"></th>
                        </tr>
                        {% endfor  %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row-center ">
        <div class="col-md-auto bg-white ">
            <a href="#">Create a Thread >></a>
        </div>  
    </div>  
</div>
{% endblock %}


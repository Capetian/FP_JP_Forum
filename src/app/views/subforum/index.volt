{% extends 'app.volt' %}

{% block content %} 
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-white">
            <div class="text-center">
                <table class="table table-hover">
                    <thead class="thead bg-primary text-white text-center">
                        <tr>
                            <th scope="col" class="th text-justify"><h5>Subforums</h5></th>
                            <th scope="col"><h6>Posts</h6></th>
                        </tr>
                    </thead>
                    <tbody class="th text-center">
                        {% for subforum in subforums %}
                        <tr>
                            <th scope="row" class="th text-justify"> 
                                <div class="col-5 ">
                                        <a href="{{url('/subforum/show/') ~ subforum.id}}"><h5>{{ subforum.name }}</h5></a> 
                                        <h6 class="text-muted text-truncate">{{ subforum.description }}</h6> 
                                </div>
                            </th>
                            <th scope="row"><h6>{{ subforum.threads |length }}</h6></th>

                        </tr>
                        {% endfor  %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{% endblock %}
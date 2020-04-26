{% extends 'app.volt' %}



{% block content %}
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-white">
            <div class="text-center">
                <table class="table table-hover">
                    <thead class="thead bg-primary text-white text-justify">
                        <tr>
                            <th scope="col" class="th "><h5>Subforums</h5></th>
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
                    <thead class="thead bg-primary text-white text-center">
                        <tr>
                            <th scope="col" class="th text-justify"><h5>Lastest Discussions</h5></th>
                            <th scope="col"><h6>Replies</h6></th>
                            <th scope="col"><h6>Created</h6></th>
                            <th scope="col"><h6>Last Post</h6></th>
                        </tr>
                    </thead>
                    <tbody class="th text-center">
                        {% for thread in threads %}
                        <tr>
                            <th scope="row" class="th text-justify"> 
                            <a href="{{url('/thread/show/') ~ thread.id}}"><h5>{{ thread.title }}</h5></a> 
                            </th>
                            {% set idx = thread.replies | length %}
                            <th scope="row"><h6> {{  idx}} </h6></th>
                            <th scope="row"> {{date("j-M-y",thread.created_at)}} </th>
                            <th scope="row"> 
                                <div class="row">
                                    {{thread.replies[idx - 1].content }} 
                                </div>
                                <div class="row">
                                    {{thread.replies[idx - 1].user.username }} 
                                </div>
                                <div class="row">
                                    {{date("j-M-y",thread.replies[idx - 1].created_at) }} 
                                </div>
                            </th>
                        </tr>
                        {% endfor  %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row-center ">
        <div class="col-md-auto bg-white ">
            <a href="/thread/create">Create a Thread >></a>
        </div>  
    </div> 
</div>
{% endblock %}


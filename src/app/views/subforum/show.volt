{% extends 'app.volt' %}

{% block content %} 
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-white">
            <div class="text-center">
                <table class="table table-hover">
                    <thead class="thead bg-primary text-white text-justify">
                        <tr>
                            <th scope="col" class="th "><h5> {{ name }} </h5></th>
                            <th scope="col"><h6>Posts</h6></th>
                            <th scope="col"><h6>Created</h6></th>
                            <th scope="col"><h6>Last Post</h6></th>
                        </tr>
                    </thead>
                    <tbody class="th text-center">
                        {% for thread in threads %}
                        <tr>
                            <th scope="row" class="th text-justify"> 
                                <div class="col-5 ">
                                        <a href="{{url('/thread/show/') ~ thread.id}}" ><h5> {{thread.title}} </h5></a> 
                                </div>
                            </th>
                            <th scope="row"><h6></h6></th>
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
{% endblock %}
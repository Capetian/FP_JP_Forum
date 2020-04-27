{% extends 'app.volt' %}

{% block content %} 
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-white">
            <div class="text-center">
                <table class="table table-hover">
                    <thead class="thead bg-primary text-white text-justify">
                        <tr>
                            <th scope="col" ><h5>Users</h5></th>
                            <th scope="col"><h6>Created</h6></th>
                            <th scope="col"><h6>Role</h6></th>
                        </tr>
                    </thead>
                    <tbody class="th text-justify">
                        {% for user in users %}
                        <tr>
                            <th scope="row" > 
                                <div class="col-5 ">
                                        <a href="{{url('/user/show/') ~ user.id}}"><h5>{{ user.username }}</h5></a> 
                                </div>
                            </th>
                            <th scope="row"><h6>{{ user.created_at }}</h6></th>
                        {% if user.role == 0 %}
                        {% set role = "User" %}
                        {% elseif user.role == 1 %}
                        {% set role = "Moderator" %}
                        {% else %}
                        {% set role = "Admin" %}
                        {% endif %}
          
                            <th scope="row">  
                             <form class="form-inline ml-2" action="{{url('/admin/updateRole')}}" method="POST">
                             
                                <input type='hidden' name='<?php echo $this->security->getTokenKey() ?>'
                                    value='<?php echo $this->security->getToken() ?>'/>
                                <input type="hidden" name="uid" value="{{ user.id }}">
                                <select name="role" class="form-control" >
                                    <option value="" disabled selected> {{role}} </option>
                                    <option value="0">User</option>
                                    <option value="1">Moderator</option>
                                    <option value="2">Admin</option>
                                </select>
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Change</button>
                            </form>
                            </th>
                        </tr>
                        {% endfor  %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{% endblock %}
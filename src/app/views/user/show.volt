{% extends 'app.volt' %}

{% block content %} 
{% set usr = user |json_decode %}
    <div class="container mt-5 mx-auto">
        <div class="row ">
            <div class="col bg-light p-5">
                {% if  session.get('auth')['uid'] == usr.id  %}
                <div class="h2 mb-5">Your Profile</div>
                {% else %}
                <div class="h2 mb-5">{{usr.username}}'s Profile</div>
                {% endif %}
                <h4> {{ usr.username }} </h4>
                {% if usr.role == 0 %}
                {% set role = "User" %}
                {% elseif usr.role == 1 %}
                {% set role = "Moderator" %}
                {% else %}
                {% set role = "Admin" %}
                {% endif %}
                <h5 class="text-muted"> {{ role }} </h5>
                {% if  session.get('auth')['uid'] == usr.id  %}
                <form action="{{ url('/user/edit') }}" method="POST">
                    <input type='hidden' name='<?php echo $this->security->getTokenKey() ?>'
        value='<?php echo $this->security->getToken() ?>'/>
                     <input type="hidden" name="uid" value="{{ session.get('auth')['uid'] }}">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your new email" value="{{usr.email}}">
                        </div>
                        <div class="col-md-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Your new password">
                        </div>
                        <div class="col-md-3">
                            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-auto">Edit</button>
                </form>
                {% else %}
                <h4> {{ usr.email }} </h4>
                {% endif %}
            </div>
        </div>
    </div>
{% endblock %}
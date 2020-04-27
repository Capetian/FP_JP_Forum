{% extends 'app.volt' %}

{% block content %} 
    <div class="container mt-5 mx-auto">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="/index">Home</a></li>
                    <li class="breadcrumb-item"><a href="/subforum/index">Thread</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="row ">
            <div class="col bg-light p-5">
                <div class="h2 mb-5">Create a Thread</div>
                <form action="{{ url('/thread/store') }}" method="POST">
                    <input type='hidden' name='<?php echo $this->security->getTokenKey() ?>'
        value='<?php echo $this->security->getToken() ?>'/>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <select name="sid" class="form-control">
                            {% for subforum in subforums %}
                                <option value="{{subforum.id}}">{{subforum.name}}</option>
                            {% endfor %}
                            </select>
                        </div>
                    </div>
                     <input type="hidden" name="uid" value="{{ session.get('auth')['uid'] }}">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Thread Topic">
                        </div>
                    </div>
                    <div class="form-group row pb-1">
                        <div class="col-md-9">
                            <textarea class="form-control" id="content" name="content" placeholder="First post ..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-auto">Create</button>
                </form>
            </div>
        </div>
    </div>
{% endblock %}
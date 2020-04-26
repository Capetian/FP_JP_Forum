{% extends 'app.volt' %}

{% block content %} 
    <div class="container mt-5 mx-auto">
        <div class="row ">
            <div class="col bg-light p-5">
                <div class="h2 mb-5">Your Profile</div>
                <h4> {{ user.username }} </h4>
                <form action="{{ url('/user/edit') }}" method="POST">
                     <input type="hidden" name="email" value="{{ session.get('auth')['uid'] }}">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your new email" value="{{user.email}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-auto">Edit</button>
                </form>
            </div>
        </div>
    </div>
{% endblock %}
{% extends 'app.volt' %}

{% block content %} 
    <div class="container mt-5 mx-auto">
        <div class="row justify-content-md-center">
            <div class="col-md-auto bg-light border rounded p-5">
                <div class="text-center">
                    <div class="h2 mb-5">Register</div>
                    <form action="{{ url('/index/store') }}" method="POST">
                    
                        <input type='hidden' name='<?php echo $this->security->getTokenKey() ?>'
                            value='<?php echo $this->security->getToken() ?>'/>
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="username">Username</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
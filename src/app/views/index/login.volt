{% extends 'app.volt' %}

{% block content %} 
    <div class="container mt-5 mx-auto">
        <div class="row justify-content-md-center">
            <div class="col-md-auto bg-light border rounded p-5">
                <div class="text-center">
                    <div class="h2 mb-5">Login</div>
                    <form action="{{ url('/index/signin') }}" method="POST">
                    
                        <input type='hidden' name='<?php echo $this->security->getTokenKey() ?>'
                            value='<?php echo $this->security->getToken() ?>'/>
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="em">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="em" name="em">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="pw">Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="pw" name="pw">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
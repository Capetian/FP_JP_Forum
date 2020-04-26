{% extends 'app.volt' %}

{% block content %} 
    <div class="container mt-5 mx-auto">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="/index">Home</a></li>
                    <li class="breadcrumb-item"><a href="/subforum/index">Subforum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
        <div class="row ">
            <div class="col bg-light p-5">
                <div class="h2 mb-5">Create a Subforum</div>
                <form action="{{ url('/subforum/store') }}" method="POST">
                    <div class="form-group row">
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Subforum Name">
                        </div>
                    </div>
                    <div class="form-group row pb-1">
                        <div class="col-md-9">
                            <textarea class="form-control" id="desc" name="desc" placeholder="Insert Subforum Description ..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-auto">Create</button>
                </form>
            </div>
        </div>
    </div>
{% endblock %}
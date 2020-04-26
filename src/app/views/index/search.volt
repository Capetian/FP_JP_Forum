{% extends 'app.volt' %}

{% block content %} 
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-light p-5">
            <div class="row justify-content-between">
                <div class="col-4">
                    <div class="row">
                        <h4> Search Results </h4>
                    </div>
                </div>
            </div>
            <table class="table border-top border-bottom">
                <tbody class="th text-center">
                    {% for result in results %}
                    <tr>
                        <th>
                            <div class="row text-justify">
                                <div class="col">
                                   <a href="/thread/show/{{result.id}}">  <h5>{{ result.title}}</h5></a> 
                                    <h6> By : {{ result.user.username}} </h6>
                                </div>
                            </div>
                        </th>
                    </tr>
                    {% endfor  %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endblock %}
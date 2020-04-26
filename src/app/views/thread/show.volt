{% extends 'app.volt' %}

{% block content %} 
{% set rt = root| json_decode %}
{% set sb = root.subforum| json_decode %}
<div class="container mt-5">
    <div class="row-center mt-5">
        <div class="col-md-auto bg-light p-5">
            <div class="row justify-content-between">
                <div class="col-4">
                    <div class="row">
                        <h4> {{root.title}} </h4>
                    </div>
                    <div class="row">
                        <h5> By {{root.user.username}} </h5>
                    </div>
                    <div class="row ">
                        <form class="form-inline" action="{{url('/thread/lock/')}}" method="POST">
                            <input type="hidden" name="l_id" value="{{rt.id}}">
                            <button class="btn btn-link text-info my-2 my-sm-0" type="submit"><h6>Lock</h6></button>
                            
                        </form> <h5>|</h5>
                        <form class="form-inline" action="{{url('/thread/delete/')}}" method="POST">
                            <input type="hidden" name="d_id" value="{{rt.id}}">
                            <button class="btn btn-link text-danger my-2 my-sm-0" type="submit"><h6>Delete</h6></button>
                        </form> <h5>|</h5>
                        <form class="form-inline" action="{{url('/thread/pin/')}}" method="POST">
                            <input type="hidden" name="p_id" value="{{rt.id}}">
                            <button class="btn btn-link my-2 text-success my-sm-0" type="submit"><h6>Pin</h6></button>
                        </form>
                    </div>
                </div>
                <div class="col-4 align-self-center">
                    <div class="row">
                        <h6>Created at: {{root.created_at}}</h6>
                    </div>
                    <div class="row">
                        <h6>Last Reply: {{root.updated_at}}</h6>
                    </div>
                </div>
            </div>
            <table class="table border-top border-bottom">
                <tbody class="th text-center">
                    {% for reply in replies %}
                        {% set rep = reply| json_decode %}
                        {% set usr = reply.user| json_decode %}
                    <tr>
                        <th>
                            <div class="row text-justify">
                                <div class="col-1">
                                    <div class="row">
                                    picture
                                    </div>
                                    <div class="row text-center" >
                                        <h6  style="word-wrap:break-word;width:50px;"> {{reply.user.username}}</h6>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h5> {{reply.content}} </h5>
                                </div>
                                <div class="col-2">
                                    <div class="row">
                                        {% if  session.get('auth')['uid'] == usr.id  %}
                                        <form class="form-inline" action="{{url('/thread/edit') }}"method="POST">
                                            <input type="hidden" name="e_id" value="{{rep.id}}">
                                            <button class="btn btn-link my-2 my-sm-0" type="submit"><h6>Edit</h6></button>
                                        </form>
                                        <h5>|</h5>
                                        {% endif %}
                                        <form class="form-inline" action="{{url('/thread/hide') }}" method="POST">
                                            <input type="hidden" name="h_id" value="{{rep.id}}">
                                            <button class="btn btn-link text-danger my-2 my-sm-0" type="submit"><h6>Delete</h6></button>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <h6>Created at: {{reply.created_at}}</h6>
                                    </div>
                                    <div class="row">
                                        <h6>Edited at: {{reply.updated_at}}</h6>
                                    </div>
                                </div>
                            </div>
                        </th>
                    </tr>
                    {% endfor  %}
                </tbody>
            </table>
            {% if rt.locked == 0 %}
            <div class="row">
                <div class="col">
                    <div class="h4 mb-3">Reply to Thread</div>
                        <form action="{{ url('/thread/reply') }}" method="POST">
                            <input type="hidden" name="r_id" value="{{ rt.id }}">
                            <input type="hidden" name="r_uid" value="{{ session.get('auth')['uid'] }}">
                            <input type="hidden" name="r_sid" value="{{sb.id }}">
                            <div class="form-group row pb-1">
                                <div class="col-md">
                                    <textarea class="form-control" id="content" name="content" placeholder="Reply to thread..."></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-auto">Reply</button>
                        </form>
                    </div>
                </div>
            </div>
            {% endif %}
        </div>
    </div>
</div>
{% endblock %}
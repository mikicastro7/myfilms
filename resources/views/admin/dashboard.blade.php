@extends('layouts.main')
@section('content')
    <div class="container">
        <h1 class="title">ADMIN</h1>
        <div class="admin-dashboard">
            <div class="admin-item-parent">
                <a class="link-admin" href="/admin/users">
                    <div class="admin-item">
                        <span class="big-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                        <h2 class="item-title">Users</h2>
                    </div>
                </a>
            </div>

            <div class="admin-item-parent">
                <a class="link-admin" href="/admin/movies">
                    <div class="admin-item">
                        <span class="big-icon"><i class="fa fa-film" aria-hidden="true"></i></span>
                        <h2 class="item-title">Movies</h2>
                    </div>
                </a>
            </div>
            <div class="admin-item-parent" style="display: none">
                <a class="link-admin" href="">
                    <div class="admin-item">
                        <span class="big-icon"><i class="fa fa-comments-o" aria-hidden="true"></i></span>
                        <h2 class="item-title">Comments</h2>
                    </div>
                </a>
            </div>
            <div class="admin-item-parent">
                <a class="link-admin" href="/admin/categories">
                    <div class="admin-item">
                        <span class="big-icon"><i class="fa fa-filter" aria-hidden="true"></i></span>
                        <h2 class="item-title">Categories</h2>
                    </div>
                </a>
            </div>
            <div class="admin-item-parent" style="display: none">
                <a class="link-admin" href="">
                    <div class="admin-item">
                        <span class="big-icon"><i class="fa fa-paypal" aria-hidden="true"></i></span>
                        <h2 class="item-title">Bills</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
@stop

<style>
body {
    position: relative;
}

body::after {
    content: '';
    display: block;
    height: 415px;
}

footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 415px;
}
.title{
    margin-top: -15px;
    text-align: center;
    font-weight: bolder;
    margin-bottom: 20px;
    font-family: 'Roboto', sans-serif;
}
.big-icon{
    text-align: center;
    font-size: 190px;
    padding-bottom: 30px;
}

.admin-dashboard{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
.item-title{
    text-align: center;
    color: black;
    font-weight: bolder;
}
.admin-item{
    padding-left: 25px;
    padding-right: 25px;
    border: 2.5px solid #dedede;
    height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 250px;
}
.link-admin{
    color: grey;
    transition: 0.4s;
}
.link-admin:hover{
    text-decoration: none;
    color: black;
}
.admin-item-parent{
    margin-left: 20px;
    margin-right: 20px;
    margin-bottom: 40px;
}

</style>

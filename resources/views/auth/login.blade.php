<x-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mx-auto">
                    <div class="card p-5 my-5 shadow-sm">
                        <form method="POST">
                            @csrf
                            <h3 class="text-center">Login Form</h3>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <x-error name="email"/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                <x-error name="password"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>

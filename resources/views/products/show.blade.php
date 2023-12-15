<h1>
    Edit Product
</h1>
<form action="{{ url('/products/') . $id }}" method="post">
    @csrf
    @method('PUT')
    <button type="submit">
        Save Changes
    </button>
</form>
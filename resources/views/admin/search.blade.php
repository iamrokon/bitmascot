<div class="topnav">
    <span style="font-size: 30px">User List</span>
    <div class="search-container">
      <form method="POST" id="search" action="{{ route('search') }}">
        @csrf
        <input type="text" placeholder="Search.." name="search_data" id="search_data">
      </form>
    </div>
  </div>

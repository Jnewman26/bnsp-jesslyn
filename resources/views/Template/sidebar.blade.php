<span class="text-center fs-3 fw-semibold">Jesslyn Book</span>
<ul class="list-unstyled">
    <li class="mt-4">
        <a href="{{ url('book') }}" class="text-decoration-none {{ Request::is('book') ? 'text-primary' : ' text-dark' }}">
            Book
        </a>
    </li>
    <li class="mt-4">
        <a href="{{ url('borrow') }}" class="text-decoration-none {{ Request::is('borrow') ? 'text-primary' : ' text-dark' }}">
            Borrow
        </a>
    </li>
    <li class="mt-4">
        <a href="{{ url('member') }}" class="text-decoration-none {{ Request::is('member') ? 'text-primary' : ' text-dark' }}">
            Member
        </a>
    </li>
</ul>

<!-- Navigation -->
        <h6 class="navbar-heading text-muted">
          @if(auth()->user()->role == 'admin')
             Gerir Dados
          @else
             Menu
          @endif
        </h6>
        <ul class="navbar-nav">
          @if(auth()->user()->role == 'admin')
            <li class="nav-item">
              <a class="nav-link" href="/home">
                <i class="ni ni-tv-2 text-orange"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/specialties">
                <i class="ni ni-planet text-blue"></i> Especialidades
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/doctors">
                <i class="ni ni-single-02 text-orange"></i> Médicos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/patients">
                <i class="ni ni-satisfied text-info"></i> Pacientes
              </a>
            </li>
          @elseif(auth()->user()->role == 'doctor')
            <li class="nav-item">
              <a class="nav-link" href="/schedule">
                <i class="ni ni-calendar-grid-58 text-danger"></i> Gerir Horário
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/specialties">
                <i class="ni ni-time-alarm text-primary"></i> As minhas Consultas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/patients">
                <i class="ni ni-satisfied text-info"></i> Os meus Pacientes
              </a>
            </li>
          @else {{-- Pacientes --}}
            <li class="nav-item">
              <a class="nav-link" href="/appointments/create">
                <i class="ni ni-send text-danger"></i> Marcar Consulta
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/appointments">
                <i class="ni ni-time-alarm text-primary"></i> As minhas Consultas
              </a>
            </li>

          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
              <i class="ni ni-key-25 text-primary"></i> Encerrar Sessão
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display:none;" id="formLogout">
              @csrf
            </form>
          </li>
        </ul>

        @if(auth()->user()->role == 'admin')
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading text-muted">Relatórios</h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="ni ni-collection text-yellow"></i> Frequência de Consultas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="ni ni-spaceship text-red"></i> Médicos mais Ativos
              </a>
            </li>
          </ul>
        @endif
@extends('_layouts.master')

@section('content')
  <div class="container_single">
    <div class="container_single_top">
      <h1>{{Lang::get('all.nav.online')}}</h1>
    </div>
    <div class="container_single_body">
      @if(count($users) === 0)
          <center>Aucun joueurs en lignes</center>
      @else
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Nom</th>
              <th>Faction</th>
              <th>Classe</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $index => $user)
              <tr>
                <td class="strong">{{$index + 1}}</td>
                <td>{{$user->name}}</td>
                <td><span class="{{Lang::get('aion.race_logo.'.$user->race)}}"></span></td>
                <td><span class="charactericon-class {{Lang::get('aion.class_logo.'.$user->player_class)}}"></span></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
      <!-- Pagination -->
      {!! $users->render() !!}
    </div>
  </div>
@stop

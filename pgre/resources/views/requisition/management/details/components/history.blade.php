<div class="modal fade" id="req_history_{{$req_details->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Histórico requisição</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="timeline">

                        @if(isset($req_details->created_at))
                            <div>
                                <i class="fas fa-plus-circle bg-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> {{$req_details->created_at}} </span>
                                    <h3 class="timeline-header no-border"><a href="#" style="color: #1a88ff">{{$req_details->created_by_user->name}}</a> criou a requisição</h3>
                                </div>
                            </div>
                        @endif
                        @if(isset($req_details->request_user_id))
                                <div>
                                    <i class="fas fa-user-circle bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$req_details->created_at}} </span>
                                        <h3 class="timeline-header no-border"><a href="#" style="color: #1a88ff">{{$req_details->request_user->name}}</a> foi assignado à requisição</h3>
                                    </div>
                                </div>
                        @endif
                        @if(isset($req_details->approved_at))
                                <div>
                                    <i class="fas fa-check bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$req_details->approved_at}} </span>
                                        <h3 class="timeline-header no-border"><a href="#" style="color: #1a88ff">{{$req_details->approved_by_user->name}}</a> aprovou a requisição</h3>
                                    </div>
                                </div>
                        @endif
                            @if(isset($req_details->canceled_at))
                                <div>
                                    <i class="fas fa-ban bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$req_details->canceled_at}} </span>
                                        <h3 class="timeline-header no-border"><a href="#" style="color: #1a88ff">{{$req_details->canceled_by_user->name}}</a> cancelou a requisição</h3>
                                        @if(isset($req_details->canceled_obs))
                                            <div class="timeline-body">
                                                <b>Razão de cancelamento:</b>
                                                </br>
                                                {{$req_details->canceled_obs}}</br>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if(isset($req_details->delivered_at))
                                <div>
                                    <i class="fas fa-arrow-alt-circle-right bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$req_details->delivered_at}} </span>
                                        <h3 class="timeline-header no-border"><a href="#" style="color: #1a88ff">{{$req_details->delivered_by_user->name}}</a> registou entrega</h3>
                                        <div class="timeline-body">
                                            <b>Equipamentos entregues:</b></br>
                                            @foreach($req_details->lines as $line)
                                                {{$line->equipment->reference}} - {{$line->equipment->description}} @if(isset($line->equipment->serial))| <b>s/n:</b> {{$line->equipment->serial}} - @endif <b>Estado:</b> @if($line->delivery_status == 1) OK @else NOK @endif  </br>
                                            @endforeach
                                            <b>Quem levantou:</b>
                                            </br>
                                            {{$req_details->picked_up_by}}</br>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(isset($req_details->returned_at))
                                <div>
                                    <i class="fas fa-arrow-alt-circle-left bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$req_details->returned_at}} </span>
                                        <h3 class="timeline-header no-border"><a href="#" style="color: #1a88ff">{{$req_details->closed_by_user->name}}</a> registou devolução</h3>
                                        <div class="timeline-body">
                                            <b>Equipamentos devolvidos:</b></br>
                                            @foreach($req_details->lines as $line)
                                                {{$line->equipment->reference}} - {{$line->equipment->description}} @if(isset($line->equipment->serial))| s/n: {{$line->equipment->serial}}@endif <b>Estado:</b> @if($line->return_status == 1) OK @else NOK @endif</br>
                                                @endforeach
                                                <b>Quem devolveu:</b>
                                                </br>
                                                {{$req_details->returned_by}}</br>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(isset($req_details->closed_at))
                                <div>
                                    <i class="fas fa-stop-circle bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$req_details->closed_at}} </span>
                                        <h3 class="timeline-header no-border"><a href="#" style="color: #1a88ff">{{$req_details->closed_by_user->name}}</a> fechou a requisição</h3>
                                    </div>
                                </div>
                            @endif


                    </div>
                </div>
                <div class="modal-footer">
                    <x-adminlte-button class="btn-flat" data-dismiss="modal" label="Fechar" theme="info" icon="fas fa-lg fa-times"/>
                </div>
        </div>
    </div>
</div>

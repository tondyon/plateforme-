@extends('layouts.app')
@section('title', $meeting->title)
@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4">{{ $meeting->title }}</h2>
    <div class="flex space-x-4">
        <video id="localVideo" autoplay muted class="w-1/2 bg-black"></video>
        <video id="remoteVideo" autoplay class="w-1/2 bg-black"></video>
    </div>
</div>
<script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
<script>
    const roomId = '{{ $meeting->id }}';
    const hostId = 'host_' + '{{ $meeting->formateur_id }}' + '_' + roomId;
    const isHost = (hostId === 'host_' + '{{ Auth::id() }}' + '_' + roomId);
    const peerId = (isHost ? 'host_' : 'guest_') + '{{ Auth::id() }}' + '_' + roomId;
    const peer = new Peer(peerId, {host: 'peerjs-server.herokuapp.com', secure: true, port: 443});
    let localStream;

    navigator.mediaDevices.getUserMedia({video: true, audio: true}).then(stream => {
        localStream = stream;
        document.getElementById('localVideo').srcObject = stream;
        peer.on('call', call => {
            call.answer(stream);
            call.on('stream', remoteStream => {
                document.getElementById('remoteVideo').srcObject = remoteStream;
            });
        });
    }).catch(err => console.error(err));

    peer.on('open', id => {
        console.log('Peer connected with ID:', id);
        if (!isHost) {
            const call = peer.call(hostId, localStream);
            call.on('stream', remoteStream => {
                document.getElementById('remoteVideo').srcObject = remoteStream;
            });
        }
    });
</script>

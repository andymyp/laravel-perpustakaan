<div style="border: 1px solid #000; padding: 20px; width: 350px;">
  <table border="0" cellspacing="0" cellpadding="3" width="100%">
    <tr>
      <td colspan="3" align="center">
        <h3>Kartu Anggota</h3>
      </td>
    </tr>
    <tr>
      <td width="100">Kode Anggota</td>
      <td width="10">:</td>
      <td>{{ $data->kode_anggota }}</td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td>{{ $data->nama }}</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>{{ $data->jenis_kelamin }}</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>{{ $data->alamat }}</td>
    </tr>
    <tr>
      <td>No. Hp</td>
      <td>:</td>
      <td>{{ $data->no_hp }}</td>
    </tr>
  </table>
</div>
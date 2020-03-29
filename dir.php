var files = <?php $out = array();
foreach (glob('usr/*.jpg') as $filename) {
    $p = pathinfo($filename);
    $out[] = $p['filename'];
}
echo json_encode($out); ?>;
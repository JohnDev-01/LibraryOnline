<?php
class DBGestionLibreria {
  private $server = "localhost";
  private $database = "dblibreria";
  private $user = "root";
  private $password = "";

  // Método para obtener la conexión
  private function getConexion() {
    try {
        $dns = "mysql:host={$this->server};dbname={$this->database};charset=utf8mb4";
        $obPDO = new PDO($dns, $this->user, $this->password);
        $obPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $obPDO;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
  }

  public function getTiendas() {
    try {
        $pdoConexion = $this->getConexion();
        $sql = "SELECT * from titulos;";
        $stmt = $pdoConexion->query($sql);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<script>console.log(" . json_encode($resultado) . ");</script>";

        return $resultado;
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
        echo "<script>console.log('{$e->getMessage()}');</script>";
    }
  }
}

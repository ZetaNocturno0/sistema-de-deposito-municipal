<?

require_once("DBManager.class.php");

class Inventario{	
	private $idinv;
	private $num;
	private $fgd;	
	private $fcd;
	private $fp;
	private $vi;
	private $lp;
	private $lu;
	private $llan;
	private $vas;
	private $ee;
	private $cha;
	private $ante;
	private $paracho;
	private $llanre;
	private $tab;
	private $chapa;
	private $radio;
	private $ence;
	private $piso;
	private $mani;
	private $cenice;
	private $parasol;
	private $ei;
	private $code;
	private $gata;
	private $llaru;
	private $ador;
	private $bate;
	private $radiador;
	private $arranca;
	private $alterna;
	private $carbu;
	private $puri;
	private $distri;
	private $bobi;
	private $ta;
	private $bujia;
	private $vca;
//metodo para guardar un nuevo detalle de orden de compra
public function Crear($num,$fgd,$fcd,$fp,$vi,$lp,$lu,$llan,$vas,$ee,$cha,$ante,$paracho,$llanre,$tab,$chapa,$radio,$ence,$piso,$mani,$cenice,$parasol,$ei,$code,$gata,$llaru,$ador,$bate,$radiador,$arranca,$alterna,$carbu,$puri,$distri,$bobi,$ta,$bujia,$vca)
	{
		$resp=false;		
		$db= new DBManager('root','');	
	if($db->_execute("INSERT INTO tb_inventario(id_inventario,id_internamiento,inventario_faro_grande_delantero,inventario_faro_chico_delantero,inventario_faro_posterior,inventario_visores,inventario_limpia_parabrisa,inventario_lunas,inventario_llantas,inventario_vasos,inventario_espejo_exterior,inventario_chapas,inventario_antena,inventario_parachoque,inventario_llanta_repuesto,inventario_tablero,inventario_chapa_contacto,inventario_radio,inventario_encendedor,inventario_piso,inventario_manija,inventario_cenicero,inventario_parasoles,inventario_espejo_interior,inventario_coderas,inventario_gata,inventario_llave_rueda,inventario_adornos,inventario_bateria,inventario_radiador,inventario_arrancador,inventario_alternador,inventario_carburador,inventario_purificador,inventario_distribuidor,inventario_bobina,inventario_tapa_aceite,inventario_bujia,inventario_vehiculo_centro_antibloqueo) VALUES(null,'".$num."','".$fgd."','".$fcd."','".$fp."','".$vi."','".$lp."','".$lu."','".$llan."','".$vas."','".$ee."','".$cha."','".$ante."','".$paracho."','".$llanre."','".$tab."','".$chapa."','".$radio."','".$ence."','".$piso."','".$mani."','".$cenice."','".$parasol."','".$ei."','".$code."','".$gata."','".$llaru."','".$ador."','".$bate."','".$radiador."','".$arranca."','".$alterna."','".$carbu."','".$puri."','".$distri."','".$bobi."','".$ta."','".$bujia."','".$vca."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}//fin metodo
	
	public function Actualizar($id,$num,$fgd,$fcd,$fp,$vi,$lp,$lu,$llan,$vas,$ee,$cha,$ante,$paracho,$llanre,$tab ,$chapa,$radio,$ence,$piso,$mani,$cenice,$parasol,$ei,$code,$gata,$llaru,$ador,$bate,$radiador,$arranca,$alterna,$carbu,$puri,$distri,$bobi,$ta,$bujia,$vca)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("update  tb_inventario set id_internamiento='".$num."'
												,inventario_faro_grande_delantero='".$fgd."'
												,inventario_faro_chico_delantero='".$fcd."'
												,inventario_faro_posterior='".$fp."'
												,inventario_visores='".$vi."'
												,inventario_limpia_parabrisa='".$lp."'
												,inventario_lunas='".$lu."'
												,inventario_llantas='".$llan."'
												,inventario_vasos='".$vas."'
												,inventario_espejo_exterior='".$ee."'
												,inventario_chapas='".$cha."'
												,inventario_antena='".$ante."'
												,inventario_parachoque='".$paracho."'
												,inventario_llanta_repuesto='".$llanre."'
												,inventario_tablero='".$tab."'
												,inventario_chapa_contacto='".$chapa."'
												,inventario_radio='".$radio."'
												,inventario_encendedor='".$ence."'
												,inventario_piso='".$piso."'
												,inventario_manija='".$mani."'
												,inventario_cenicero='".$cenice."'
												,inventario_parasoles='".$parasol."'
												,inventario_espejo_interior='".$ei."'
												,inventario_coderas='".$code."'
												,inventario_gata='".$gata."'
												,inventario_llave_rueda='".$llaru."'
												,inventario_adornos='".$ador."'
												,inventario_bateria='".$bate."'
												,inventario_radiador='".$radiador."'
												,inventario_arrancador='".$arranca."'
												,inventario_alternador='".$alterna."'
												,inventario_carburador='".$carbu."'
												,inventario_purificador='".$puri."'
												,inventario_distribuidor='".$distri."'
												,inventario_bobina='".$bobi."'
												,inventario_tapa_aceite='".$ta."'
												,inventario_bujia='".$bujia."'
												,inventario_vehiculo_centro_antibloqueo='".$vca."' 
					where (id_inventario=".$id.")"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
// metodo para listar el detalle de orden
	public function ListarDetalleInv($vnum)
	{
		$vector=null;
		$db= new DBManager('root','');		
		$rs=$db->execute("SELECT * FROM tb_inventario WHERE (id_internamiento='".$vnum."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$row=0;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                 $vector[$row]=array("id_inventario" => $rs->fields["id_inventario"],
   			    			  	     "id_internamiento" => $rs->fields["id_internamiento"],
									 "inventario_faro_grande_delantero" => $rs->fields["inventario_faro_grande_delantero"],			 
   			    					 "inventario_faro_chico_delantero" => $rs->fields["inventario_faro_chico_delantero"],
									 "inventario_faro_posterior" => $rs->fields["inventario_faro_posterior"],
									 "inventario_visores" => $rs->fields["inventario_visores"],
									 "inventario_limpia_parabrisa" => $rs->fields["inventario_limpia_parabrisa"],
									 "inventario_lunas" => $rs->fields["inventario_lunas"],
									 "inventario_llantas" => $rs->fields["inventario_llantas"],
									 "inventario_vasos" => $rs->fields["inventario_vasos"],
									 "inventario_espejo_exterior" => $rs->fields["inventario_espejo_exterior"],
									 "inventario_chapas" => $rs->fields["inventario_chapas"],
									 "inventario_antena" => $rs->fields["inventario_antena"],
									 "inventario_parachoque" => $rs->fields["inventario_parachoque"],
									 "inventario_llanta_repuesto" => $rs->fields["inventario_llanta_repuesto"],
									 "inventario_tablero" => $rs->fields["inventario_tablero"],
									 "inventario_chapa_contacto" => $rs->fields["inventario_chapa_contacto"],
									 "inventario_radio" => $rs->fields["inventario_radio"],
									 "inventario_encendedor" => $rs->fields["inventario_encendedor"],
									 "inventario_piso" => $rs->fields["inventario_piso"],
									 "inventario_manija" => $rs->fields["inventario_manija"],
									 "inventario_cenicero" => $rs->fields["inventario_cenicero"],
									 "inventario_parasoles" => $rs->fields["inventario_parasoles"],
									 "inventario_espejo_interior" => $rs->fields["inventario_espejo_interior"],
									 "inventario_coderas" => $rs->fields["inventario_coderas"],
									 "inventario_gata" => $rs->fields["inventario_gata"],
									 "inventario_llave_rueda" => $rs->fields["inventario_llave_rueda"],
									 "inventario_adornos" => $rs->fields["inventario_adornos"],
									 "inventario_bateria" => $rs->fields["inventario_bateria"],
									 "inventario_radiador" => $rs->fields["inventario_radiador"],
									 "inventario_arrancador" => $rs->fields["inventario_arrancador"],
									 "inventario_alternador" => $rs->fields["inventario_alternador"],
									 "inventario_carburador" => $rs->fields["inventario_carburador"],
									 "inventario_purificador" => $rs->fields["inventario_purificador"],
									 "inventario_distribuidor" => $rs->fields["inventario_distribuidor"],
									 "inventario_bobina" => $rs->fields["inventario_bobina"],
									 "inventario_tapa_aceite" => $rs->fields["inventario_tapa_aceite"],
									 "inventario_bujia" => $rs->fields["inventario_bujia"],
									 "inventario_vehiculo_centro_antibloqueo" => $rs->fields["inventario_vehiculo_centro_antibloqueo"]);
                
   			    $row++;
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
        	return $vector;			
		}else return null;
		
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              						
	}//fin metodo	
	
	public function BuscarPorCodigo($vcodmarc)
	{
		
		$resp=false;
		$num_rows=0;//numero de filas afectada por la consulta
		$db= new DBManager('root','');
		$rs=$db->execute("select * from tb_inventario where (id_internamiento = '".$vcodmarc."')");
		$num_rows=$rs->getNumOfRows();
		if($num_rows>0)
		{	$resp=true;
			$rs->firstRow(); // opcional, pero recomendado
			while (!$rs->EOF) {
                // Coleccion de campos accesible mediante arrays asociativos también
                $this->idinv=$rs->fields["id_inventario"];
   			    $this->num=$rs->fields["id_internamiento"];   	
				$this->fgd=$rs->fields["inventario_faro_grande_delantero"];   
				$this->fcd=$rs->fields["inventario_faro_chico_delantero"];   
				$this->fp=$rs->fields["inventario_faro_posterior"];   
   			    $this->vi=$rs->fields["inventario_visores"];   			  	    
				$this->lp=$rs->fields["inventario_limpia_parabrisa"];   
				$this->lu=$rs->fields["inventario_lunas"];   
				$this->llan=$rs->fields["inventario_llantas"];   
				$this->vas=$rs->fields["inventario_vasos"];   
				$this->ee=$rs->fields["inventario_espejo_exterior"];   
				$this->cha=$rs->fields["inventario_chapas"];   
				$this->ante=$rs->fields["inventario_antena"];   
				$this->paracho=$rs->fields["inventario_parachoque"];   					
				$this->llanre=$rs->fields["inventario_llanta_repuesto"];   
				$this->tab=$rs->fields["inventario_tablero"];   
				$this->chapa=$rs->fields["inventario_chapa_contacto"];
				$this->radio=$rs->fields["inventario_radio"];   
				$this->ence=$rs->fields["inventario_encendedor"];   
				$this->piso=$rs->fields["inventario_piso"];   
				$this->mani=$rs->fields["inventario_manija"];   
				$this->cenice=$rs->fields["inventario_cenicero"];   
				$this->parasol=$rs->fields["inventario_parasoles"];   
				$this->ei=$rs->fields["inventario_espejo_interior"];   					 
				$this->code=$rs->fields["inventario_coderas"];   
				$this->gata=$rs->fields["inventario_gata"];   
				$this->llaru=$rs->fields["inventario_llave_rueda"];   
				$this->ador=$rs->fields["inventario_adornos"];   
				$this->bate=$rs->fields["inventario_bateria"];   
				$this->radiador=$rs->fields["inventario_radiador"];   
				$this->arranca=$rs->fields["inventario_arrancador"];   
				$this->alterna=$rs->fields["inventario_alternador"];   
				$this->carbu=$rs->fields["inventario_carburador"];   
				$this->puri=$rs->fields["inventario_purificador"];   
				$this->distri=$rs->fields["inventario_distribuidor"];   
				$this->bobi=$rs->fields["inventario_bobina"];   
				$this->ta=$rs->fields["inventario_tapa_aceite"];   
				$this->bujia=$rs->fields["inventario_bujia"];   
				$this->vca=$rs->fields["inventario_vehiculo_centro_antibloqueo"];   
											    
				$rs->nextRow(); // Nota: nextRow() Esta situado al final				
        	}			
		}
		$rs->close(); 
		$db->closeConnection();//opcional cierra el enlace de la Base de Datos              
		return $resp;							
	}
	
	
	//metodo para eliminar un detalle
	public function Eliminar($vnum)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("DELETE FROM tb_inventario WHERE (id_inventario=".$vnum.")"))   
		{
			$resp=true;
		}
		return $resp;		
	}
	
	
	/////////funcion para eliminar todo el detalle de una venta	
	public function Eliminardetalle($vnum)
	{
		$resp=false;		
		$db= new DBManager('root','');		
		if($db->_execute("DELETE FROM tb_inventario WHERE (id_internamiento ='".$vnum."')"))   
		{
			$resp=true;
		}
		return $resp;		
	}	
	
	public function getidinv(){ return $this->idinv;}
	public function getnum(){ return $this->num;}	
	public function getfgd(){ return $this->fgd;}
	public function getfcd(){ return $this->fcd;}
	public function getfp(){ return $this->fp;}
	public function getvi(){ return $this->vi;}
	public function getlp(){ return $this->lp;}
	public function getlu(){ return $this->lu;}
	public function getllan(){ return $this->llan;}
	public function getvas(){ return $this->vas;}
	public function getee(){ return $this->ee;}
	public function getcha(){ return $this->cha;}
	public function getante(){ return $this->ante;}
	public function getparacho(){ return $this->paracho;}
	public function getllanre(){ return $this->llanre;}
	public function gettab(){ return $this->tab;}
	public function getchapa(){ return $this->chapa;}
	public function getradio(){ return $this->radio;}
	public function getence(){ return $this->ence;}
	public function getpiso(){ return $this->piso;}
	public function getmani(){ return $this->mani;}
	public function getcenice(){ return $this->cenice;}
	public function getparasol(){ return $this->parasol;}
	public function getei(){ return $this->ei;}
	public function getcode(){ return $this->code;}
	public function getgata(){ return $this->gata;}
	public function getllaru(){ return $this->llaru;}
	public function getador(){ return $this->ador;}
	public function getbate(){ return $this->bate;}
	public function getradiador(){ return $this->radiador;}
	public function getarranca(){ return $this->arranca;}
	public function getalterna(){ return $this->alterna;}
	public function getcarbu(){ return $this->carbu;}
	public function getpuri(){ return $this->puri;}
	public function getdistri(){ return $this->distri;}
	public function getbobi(){ return $this->bobi;}
	public function getta(){ return $this->ta;}
	public function getbujia(){ return $this->bujia;}
	public function getvca(){ return $this->vca;}
}//fin de clase
?>
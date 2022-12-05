# Adapter in PHP

**Adapter, uyumsuz nesnelerin işbirliği yapmasına izin veren yapısal bir tasarım desenidir.**

### Kullanım örnekleri: 

- Adapter deseni, PHP kodunda oldukça yaygındır. Bazı eski kodlara dayalı sistemlerde çok sık kullanılır. Bu gibi durumlarda Adapterler, eski kodun modern sınıflarla çalışmasını sağlar. 

### Tanımlama:

- Adapter, farklı bir özet/arayüz türünün bir örneğini alan bir oluşturucu tarafından tanınabilir. Adapter, yöntemlerinden herhangi birine bir çağrı aldığında, parametreleri uygun biçime çevirir ve ardından çağrıyı, sarılmış nesnenin bir veya birkaç yöntemine yönlendirir.

## Conceptual Example

Bu örnek, Adapter tasarım deseninin yapısını gösterir ve aşağıdaki sorulara odaklanır: 
- Hangi sınıflardan oluşur? 
- Bu sınıflar hangi rolleri oynuyor? 
- Modelin öğeleri nasıl ilişkilidir? 
Kalıbın yapısını öğrendikten sonra, gerçek dünyadan bir PHP kullanım senaryosuna dayanan aşağıdaki örneği kavramanız daha kolay olacaktır.

## Real World Example

Adapter kalıbı, kodunuzun büyük bir kısmıyla uyumsuz olsalar bile 3. taraf veya eski sınıfları kullanmanıza olanak tanır. Örneğin, uygulamanızın bildirim arayüzünü Slack, Facebook, SMS veya (adını siz koyun) gibi her bir 3. taraf hizmetini destekleyecek şekilde yeniden yazmak yerine, uygulamanızdan gelen çağrıları her 3. taraf sınıfının gerektirdiği bir arabirim ve biçim.